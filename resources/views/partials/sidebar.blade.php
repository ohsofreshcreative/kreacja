@if (is_active_sidebar('page-sidebar'))
  <aside class="c-sidebar" role="complementary">
    {{-- Funkcja WordPressa, która renderuje wszystkie widżety dodane do tego obszaru --}}
    @php(dynamic_sidebar('page-sidebar'))
  </aside>
@endif