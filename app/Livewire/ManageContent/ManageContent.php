<?php

namespace App\Livewire\ManageContent;

use Livewire\Component;

class ManageContent extends Component
{
    public $contentTypes = [
        ['title' => 'Skin Knowledge', 'route' => 'manage-content.skin-knowledge.skin-knowledge-list'],
        ['title' => 'Skin Quiz', 'route' => 'manage-content.skin-quiz'],
        ['title' => 'Ingredient Analysis', 'route' => 'manage-content.ingredient-analysis'],
        ['title' => 'Tips', 'route' => 'manage-content.tips'],
        ['title' => 'Promotion News', 'route' => 'manage-content.promotion'],
        ['title' => 'List of Prohibited Products', 'route' => 'manage-content.prohibited-products'],
    ];

    public function redirectTo($route)
    {
        return redirect()->route($route);
    }

    public function render()
    {
        return view('livewire.manage-content.manage-content');
    }
}
