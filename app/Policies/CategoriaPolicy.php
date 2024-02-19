<?php

namespace App\Policies;

use App\Helpers\Roles;
use App\Models\User;

class CategoriaPolicy
{
    protected $myHelper;

    public function __construct(Roles $myHelper)
    {
        $this->myHelper = $myHelper;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['list categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['view categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['create categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['edit categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['delete categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['restore categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['forcedelete categoria'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }
}
