<?php

namespace App\Repositories\Read\Product;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product\Product;

class ProductReadRepository implements ProductReadRepositoryInterface
{
    public function getAll(?string $query, int $page): LengthAwarePaginator
    {
        return Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('properties')
            ->orderBy('id')
            ->paginate(Product::PER_PAGE, ['*'], 'page', $page);
    }
}
