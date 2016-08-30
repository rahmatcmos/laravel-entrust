<div class="modal fade permissions-modal" tabindex="-1" role="dialog" aria-labelledby="permissions">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Permissions</h4>
    	</div>
    	<div class="modal-body">
    		<select multiple="multiple" id="select-perms">
                @if ( isset($permissions))
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                    @endforeach
                @endif
            </select>
    	</div>
    </div>
  </div>
</div>
