<?php

namespace App\Walkers;

use Walker_Nav_Menu;

class DropdownWalker extends Walker_Nav_Menu
{
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        // Wspólne bazowe klasy dla wszystkich poziomów
        $base = 'absolute z-20 bg-white shadow-2xl b-border-light focus:outline-none b-border-light';

        if ($depth === 0) {
            // Pierwszy poziom – w dół
            $pos = 'mt-2 left-0 origin-top-left min-w-[12rem] rounded-xl';
            $layout = 'p-4'; // pionowa lista
            $transition = 'x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"';
        } else {
            // Kolejne poziomy – w bok (na prawo)
            $pos = 'top-0 left-full origin-top-left';
            // DWIE KOLUMNY + rzędy, wygodne odstępy
            $layout = 'grid grid-cols-2 gap-x-1 gap-y-1 p-4 w-max rounded-xl';
            $transition = 'x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-x-2"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-2"';
        }

        $classes = trim("$base $pos $layout");

        // Jeśli używasz Alpine v2 → @click.away
        $output .= "\n<ul x-cloak x-show=\"open\" @click.outside=\"open = false\" $transition class=\"$classes\" style=\"display: none;\">\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $item_classes = is_array($item->classes) ? $item->classes : [];
        $has_children = in_array('menu-item-has-children', $item_classes, true);

        // <li> – relative, by submenu <ul> mogło być absolute względem <li>
        $li_classes = 'relative ' . esc_attr(implode(' ', array_filter($item_classes)));

        // Alpine tylko gdy są dzieci (na hover otwieramy/zamykamy)
        $alpine_attrs = $has_children ? ' x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"' : '';

        $output .= '<li class="' . $li_classes . '"' . $alpine_attrs . '>';

        // Klasy linków: top (nav) vs submenu
        if ($depth === 0) {
            $link_classes = 'inline-flex items-center gap-x-1 text-sm font-medium hover:text-indigo-600';
        } else {
            // W gridzie lepiej wąskie paddingi, bez wymuszania pełnej szerokości
            $link_classes = 'inline-block px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded whitespace-nowrap';
        }

        $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($link_classes) . '">';
        $output .= esc_html($item->title);

        // Ikony sugerujące kierunek submenu
        if ($has_children) {
            if ($depth === 0) {
                // w dół
                $output .= '<svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>';
            } else {
                // w prawo
                $output .= '<svg class="w-4 h-4 ml-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
            }
        }

        $output .= '</a>';
        // <ul> dla dzieci otworzy automatycznie start_lvl()
    }

    /**
     * Ends the element output, closing `<li>`.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }

    /**
     * Ends the list of after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "</ul>\n";
    }
}
