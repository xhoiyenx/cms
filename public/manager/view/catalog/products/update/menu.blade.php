<ul class="nav nav-tabs nav-line mb20">
@if ($form->status == 'draft')
  <li{!! is_active('manager.catalog.product.update', ' class="active"') !!}>
    <a href="{{ route('manager.catalog.product.update') }}"><strong>General</strong></a>
  </li>
  <li>
    <a href="#variation"><strong>Images</strong></a>
  </li>
@else
  <li{!! is_active('manager.catalog.product.update', ' class="active"') !!}>
    <a href="{{ route('manager.catalog.product.update', ['id' => $form->id]) }}"><strong>General</strong></a>
  </li>
  <li>
    <a href="#variation"><strong>Images</strong></a>
  </li>
@endif
</ul>