<div class="panel">
<table class="table table-bordered table-primary table-striped">
  <thead>
    <tr>
      <th width="80%">name</th>
      <th width="20%" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td>{{ $data['name'] }}</td>
      <td class="text-center">
        <ul class="table-options">
          <li><a href="{{ route('manager.catalog.categories', ['id' => $data['id']]) }}" title="Edit"><i class="fa fa-fw fa-pencil"></i></a></li>
          <li><a href="#" title="Delete"><i class="fa fa-fw fa-trash"></i></a></li>
        </ul>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="2">No Data Found</td>
    </tr>
    @endforelse
  </tbody>
</table>
{!! $list->links() !!}
</div>
