<?php

namespace App\Policies;

use App\Models\ListItems\ListItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('list_items_read') || $user->can('list_items_open');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  App\Models\ListItems\ListItem  $listItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ListItem $listItem)
    {
        

        return $user->can('list_items_read') || $user->can('list_items_open');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('list_items_open');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  App\Models\ListItems\ListItem  $listItem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ListItem $listItem)
    {
        return $user->can('list_items_open');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  App\Models\ListItems\ListItem  $listItems
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ListItem $listItem)
    {
        return $user->can('list_items_open');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  App\Models\ListItems\ListItem  $listItems
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ListItem $listItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  App\Models\ListItems\ListItem  $listItems
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ListItem $listItem)
    {
        //
    }
}
