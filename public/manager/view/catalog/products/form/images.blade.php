<div class="panel panel-inverse-full">
  <div class="panel-body">
    <div class="panel-actions">
      <a href="{{ route('manager.catalog.product.media') }}" data-id="{{ $form->id }}" class="btn btn-success btn-quirk btn-form">upload media</a>
    </div>
    <div class="row filemanager">
      @include('catalog.media.list')
    </div>
  </div>
</div>
