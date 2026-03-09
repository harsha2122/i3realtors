<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNavigationMenuRequest;
use App\Http\Requests\StoreNavigationItemRequest;
use App\Http\Requests\UpdateNavigationMenuRequest;
use App\Http\Requests\UpdateNavigationItemRequest;
use App\Models\NavigationMenu;
use App\Models\NavigationItem;
use App\Services\NavigationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NavigationController extends Controller
{
    public function __construct(private NavigationService $navigationService) {}

    public function index()
    {
        $menus = NavigationMenu::orderBy('order')->paginate(15);
        return view('admin.navigation.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.navigation.create');
    }

    public function store(StoreNavigationMenuRequest $request)
    {
        $menu = $this->navigationService->createMenu($request->validated());

        return redirect()
            ->route('admin.navigation.edit', $menu)
            ->with('success', 'Navigation menu created successfully.');
    }

    public function edit(NavigationMenu $menu)
    {
        $menu->load('items');
        $routes = $this->navigationService->getAvailableRoutes();
        $menuTree = $menu->getMenuTree();

        return view('admin.navigation.edit', compact('menu', 'routes', 'menuTree'));
    }

    public function update(UpdateNavigationMenuRequest $request, NavigationMenu $menu)
    {
        $this->navigationService->updateMenu($menu, $request->validated());

        return redirect()
            ->route('admin.navigation.edit', $menu)
            ->with('success', 'Navigation menu updated successfully.');
    }

    public function destroy(NavigationMenu $menu)
    {
        $this->navigationService->deleteMenu($menu);

        return redirect()
            ->route('admin.navigation.index')
            ->with('success', 'Navigation menu deleted successfully.');
    }

    public function addItem(StoreNavigationItemRequest $request, NavigationMenu $menu): JsonResponse
    {
        try {
            $item = $this->navigationService->addItem($menu, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Menu item added successfully.',
                'item' => $item,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateItem(UpdateNavigationItemRequest $request, NavigationItem $item): JsonResponse
    {
        try {
            $this->navigationService->updateItem($item, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Menu item updated successfully.',
                'item' => $item,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function deleteItem(NavigationItem $item): JsonResponse
    {
        try {
            $this->navigationService->deleteItem($item);

            return response()->json([
                'success' => true,
                'message' => 'Menu item deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function reorder(Request $request, NavigationMenu $menu): JsonResponse
    {
        try {
            $items = $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:navigation_items,id',
                'items.*.parent_id' => 'nullable|exists:navigation_items,id',
            ])['items'];

            $this->navigationService->reorderItems($menu, $items);

            return response()->json([
                'success' => true,
                'message' => 'Menu items reordered successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function preview(NavigationMenu $menu)
    {
        $menuData = $this->navigationService->buildMenuTree($menu);
        return view('admin.navigation.preview', compact('menuData', 'menu'));
    }

    public function duplicate(NavigationMenu $menu)
    {
        try {
            $newMenu = $this->navigationService->duplicateMenu($menu);

            return redirect()
                ->route('admin.navigation.edit', $newMenu)
                ->with('success', 'Navigation menu duplicated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function export(NavigationMenu $menu)
    {
        $data = $this->navigationService->buildMenuTree($menu);

        return response()->json($data)
            ->header('Content-Disposition', 'attachment; filename="' . $menu->slug . '.json"');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json',
        ]);

        try {
            $content = file_get_contents($request->file('file')->path());
            $data = json_decode($content, true);

            if (!isset($data['name']) || !isset($data['items'])) {
                throw new \Exception('Invalid JSON format.');
            }

            $menu = $this->navigationService->createMenu([
                'name' => $data['name'],
                'slug' => $data['slug'] ?? str()->slug($data['name']),
                'description' => $data['description'] ?? null,
                'position' => $data['position'] ?? 'custom',
            ]);

            $this->importItems($data['items'], $menu->id);

            return redirect()
                ->route('admin.navigation.edit', $menu)
                ->with('success', 'Navigation menu imported successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    private function importItems(array $items, int $menuId, ?int $parentId = null): void
    {
        foreach ($items as $index => $itemData) {
            $item = NavigationItem::create([
                'menu_id' => $menuId,
                'parent_id' => $parentId,
                'label' => $itemData['label'],
                'url' => $itemData['url'] ?? null,
                'route_name' => $itemData['route_name'] ?? null,
                'icon' => $itemData['icon'] ?? null,
                'is_external' => $itemData['is_external'] ?? false,
                'target_attribute' => $itemData['target_attribute'] ?? '_self',
                'order' => $index,
            ]);

            if (isset($itemData['children']) && is_array($itemData['children'])) {
                $this->importItems($itemData['children'], $menuId, $item->id);
            }
        }
    }
}
