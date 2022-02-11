<div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group mb-0" wire:ignore>
                    <label>Loại chi phí:</label>
                    <select class="select2 select2-costGroup" style="width: 100%;" name="costGroup"
                        wire:model='costGroup'>
                        <option>
                        </option>
                        @foreach ($costGroups as $costGroup)
                            <option value="{{ $costGroup->id }}" @if (old('costGroup') and old('costGroup') == $costGroup->id) selected = 'selected' @endif>
                                {{ $costGroup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('costGroup')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Chi</label>
                    <input type="number" class="form-control" placeholder="Nhập doanh thu ..." name="cost"
                        @if (old('cost')) value="{{ old('cost') }}" @else  @endif wire:model='cost'>
                    @error('cost')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Thực chi</label>
                    <input type="number" class="form-control" placeholder="Nhập tiền thực thu ..." name="actual_cost"
                        @if (old('actual_cost')) value="{{ old('actual_cost') }}" @else  @endif wire:model='actual_cost'>
                    @error('actual_cost')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="summernote">Mô tả chuyến vừa hoàn
                thánh (không bắt buộc)</label>
            <textarea name="description" class="form-control summernoteAdd" wire:model='costDescription'></textarea>
            @error('summernote')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-100">
            <button type="submit" class="btn btn-success btn-sm float-right"
                onclick='addCostDetail({{ $todayDoingSchedule->id }})'>Thêm</button>
        </div>
    </div>
</div>
