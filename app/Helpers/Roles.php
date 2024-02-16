<?php

namespace App\Helpers;

use App\Models\User;

class Roles
{
    public function verifyPermissionRole(array $permissions, User $user): bool
    {
        $roles = $user->getRoleNames();

        // Verifica si al menos uno de los roles está presente
        if (!empty(array_intersect($roles->toArray(), $permissions['Roles']))) {
            foreach ($permissions['Permisos'] as $permission) {
                if (!$user->hasPermissionTo($permission)) {
                    return false;
                }
            }
            return true;
        }

        return false;
    }
}
