<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function getActiveUsers(array $filters)
    {
        return User::query()
            ->select([
                'id',
                'email',
                'name',
                'role',
                'created_at',
            ])
            ->where('active', true)
            ->withCount('orders')
            ->when(
                !empty($filters['search']),
                fn ($q) => $this->applySearch($q, $filters['search'])
            )
            ->when(
                !empty($filters['sortBy']),
                fn ($q) => $this->applySorting($q, $filters['sortBy'])
            )
            ->paginate(10);
    }

    private function applySearch($query, string $search): void
    {
        $search = trim($search);

        // MySQL FULLTEXT ignores words shorter than 3 chars
        if (mb_strlen($search) >= 3) {
            // Prefix search using BOOLEAN MODE
            $query->whereRaw(
                "MATCH(name, email) AGAINST(? IN BOOLEAN MODE)",
                [$search . '*']
            );
        } else {
            // Fallback for very short searches
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "{$search}%")
                ->orWhere('email', 'like', "{$search}%");
            });
        }
    }

    private function applySorting($query, ?string $sortBy): void
    {
        $allowed = ['name', 'email', 'created_at'];
        $query->orderBy(
            in_array($sortBy, $allowed) ? $sortBy : 'created_at'
        );
    }
}
