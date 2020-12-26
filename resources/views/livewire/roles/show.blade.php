<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-eye"></i> Detail Role
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="my-input">Name</label>
                        <input id="my-input" class="form-control @error('name') is-invalid @enderror" type="text" name="" wire:model="name" placeholder="Name..." disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="my-input">Permission</label>
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" wire:model="checkbox_all"  value="" disabled></th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $key => $value)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="@error('checkbox_values') is-invalid @enderror" wire:model="checkbox_values" value="{{ $value->{$checkbox_attribute} }}" disabled>
                                    </td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

