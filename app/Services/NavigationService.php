<?php

namespace App\Services;

use App\Models\NavigationItem;
use App\Models\NavigationMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class NavigationService
{
    private const CACHE_PREFIX = 'navigation_menu_';
    private const CACHE_TTL = 3600; // 1 hour

    public function getMenu(string $slug)
    {
        $cacheKey = self::CACHE_PREFIX . $slug;

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($slug) {
            $menu = NavigationMenu::bySlug($slug)
                ->active()
                ->with(['rootItems.children'])
                ->first();

            if (!$menu) {
                return null;
            }

            return $this->buildMenuTree($menu);
        });
    }

    public function buildMenuTree(NavigationMenu $menu)
    {
        return [
            'id' => $menu->id,
            'name' => $menu->name,
            'slug' => $menu->slug,
            'position' => $menu->position,
            'items' => $this->formatItems($menu->rootItems()->with('children')->get()),
        ];
    }

    private function formatItems($items)
    {
        return $items->map(function ($item) {
            return [
                'id' => $item->id,
                'label' => $item->label,
                'url' => $item->getUrl(),
                'icon' => $item->icon,
                'is_external' => $item->is_external,
                'target' => $item->target_attribute,
                'children' => $item->children->count() > 0 ? $this->formatItems($item->children) : [],
            ];
        })->toArray();
    }

    public function createMenu(array $data): NavigationMenu
    {
        return NavigationMenu::create($data);
    }

    public function updateMenu(NavigationMenu $menu, array $data): NavigationMenu
    {
        $menu->update($data);
        $this->invalidateCache($menu);
        return $menu;
    }

    public function deleteMenu(NavigationMenu $menu): bool
    {
        $this->invalidateCache($menu);
        return $menu->delete();
    }

    public function addItem(NavigationMenu $menu, array $data): NavigationItem
    {
        $data['menu_id'] = $menu->id;

        // Ensure parent_id belongs to the same menu
        if (!empty($data['parent_id'])) {
            $parent = NavigationItem::where('id', $data['parent_id'])
                ->where('menu_id', $menu->id)
                ->first();

            if (!$parent) {
                $data['parent_id'] = null;
            }
        }

        $item = NavigationItem::create($data);
        $this->invalidateCache($menu);

        return $item;
    }

    public function updateItem(NavigationItem $item, array $data): NavigationItem
    {
        // Prevent setting parent as self
        if (!empty($data['parent_id']) && $data['parent_id'] == $item->id) {
            unset($data['parent_id']);
        }

        $item->update($data);
        $this->invalidateCache($item->menu);

        return $item;
    }

    public function deleteItem(NavigationItem $item): bool
    {
        $menu = $item->menu;
        $result = $item->delete();

        if ($result) {
            $this->invalidateCache($menu);
        }

        return $result;
    }

    public function reorderItems(NavigationMenu $menu, array $items): void
    {
        foreach ($items as $index => $itemData) {
            $item = NavigationItem::find($itemData['id']);

            if ($item && $item->menu_id === $menu->id) {
                $item->update([
                    'order' => $index,
                    'parent_id' => $itemData['parent_id'] ?? null,
                ]);
            }
        }

        $this->invalidateCache($menu);
    }

    public function invalidateCache(NavigationMenu $menu): void
    {
        Cache::forget(self::CACHE_PREFIX . $menu->slug);
    }

    public function validateRoute(string $routeName): bool
    {
        try {
            Route::getRoutes()->getByName($routeName);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAvailableRoutes(): array
    {
        try {
            $cacheKey = 'available_routes';

            return Cache::remember($cacheKey, 3600, function () {
                $routes = [];

                foreach (Route::getRoutes() as $route) {
                    if ($route->getName() && !str_starts_with($route->getName(), 'admin.') && !str_starts_with($route->getName(), 'generated_')) {
                        $routes[$route->getName()] = $route->getName();
                    }
                }

                return $routes;
            });
        } catch (\Exception $e) {
            // If route fetching fails, return empty array instead of crashing
            return [];
        }
    }

    public function duplicateMenu(NavigationMenu $menu): NavigationMenu
    {
        $newMenu = $menu->replicate();
        $newMenu->name = $menu->name . ' (Copy)';
        $newMenu->slug = $menu->slug . '-copy-' . time();
        $newMenu->save();

        // Duplicate items
        $this->duplicateItems($menu->items, $newMenu->id);

        return $newMenu;
    }

    private function duplicateItems($items, int $newMenuId, ?int $newParentId = null): void
    {
        foreach ($items as $item) {
            $newItem = $item->replicate();
            $newItem->menu_id = $newMenuId;
            $newItem->parent_id = $newParentId;
            $newItem->save();

            if ($item->children->count() > 0) {
                $this->duplicateItems($item->children, $newMenuId, $newItem->id);
            }
        }
    }
}
