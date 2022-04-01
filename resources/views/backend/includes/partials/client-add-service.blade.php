<div class="row">
	<div class="col-sm-6">
		<div class="row">
			{{-- Producer --}}
            <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('producer') ? ' has-danger' : '' }}">
                <label class="bmd-label-floating">Producent</label>
                <input class="form-control" name="producer" id="input-producer" type="text" value="{{ old('producer') }}" />
                @if ($errors->has('producer'))
                <span class="material-icons form-control-feedback">clear</span>
                <span id="producer-error" class="error text-danger" for="input-producer">{{ $errors->first('producer') }}</span>
                @endif
            </div><!--form control-->
        </div>
        <div class="row">
        	{{-- Model --}}
            <div class="col-sm-12 form-group bmd-form-group {{ $errors->has('model') ? ' has-danger' : '' }}">
                <label class="bmd-label-floating">Model</label>
                <input class="form-control" name="model" id="input-model" type="text" value="{{ old('model') }}" />
                @if ($errors->has('model'))
                <span class="material-icons form-control-feedback">clear</span>
                <span id="model-error" class="error text-danger" for="input-model">{{ $errors->first('model') }}</span>
                @endif
            </div><!--form control-->
        </div>
        <div class="row">
        	{{-- Outside Unit --}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('out_unit') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Jednostka zewnętrzna</label>
	            <input class="form-control" name="out_unit" id="input-out_unit" type="text" value="{{ old('out_unit') }}" />
	            @if ($errors->has('out_unit'))
	            <span id="out_unit-error" class="error text-danger" for="input-out_unit">{{ $errors->first('out_unit') }}</span>
	            @endif
	        </div><!--form control-->
	        {{-- Outside Unit Serial Number--}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('out_unit_sn') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Numer Seryjny Jedn. zewn.</label>
	            <input class="form-control" name="out_unit_sn" id="input-out_unit_sn" type="text" value="{{ old('out_unit_sn') }}" />
	            @if ($errors->has('out_unit_sn'))
	            <span class="material-icons form-control-feedback">clear</span>
	            <span id="out_unit_sn-error" class="error text-danger" for="input-out_unit_sn">{{ $errors->first('out_unit_sn') }}</span>
	            @endif
	        </div><!--form control-->
        </div>
        <div class="row">
        	{{-- Inside Unit --}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('in_unit') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Jednostka wewnętrzna</label>
	            <input class="form-control" name="in_unit" id="input-in_unit" type="text" value="{{ old('in_unit') }}" />
	            @if ($errors->has('in_unit'))
	            <span class="material-icons form-control-feedback">clear</span>
	            <span id="in_unit-error" class="error text-danger" for="input-in_unit">{{ $errors->first('in_unit') }}</span>
	            @endif
	        </div><!--form control-->
	        {{-- Inside Unit Serial Number--}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('in_unit_sn') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Numer Seryjny Jedn. Wewn.</label>
	            <input class="form-control" name="in_unit_sn" id="input-in_unit_sn" type="text" value="{{ old('in_unit_sn') }}" />
	            @if ($errors->has('in_unit_sn'))
	            <span class="material-icons form-control-feedback">clear</span>
	            <span id="in_unit_sn-error" class="error text-danger" for="input-in_unit_sn">{{ $errors->first('in_unit_sn') }}</span>
	            @endif
	        </div><!--form control-->
        </div>
	</div>
	<div class="col-sm-6">
		<div class="row">
        	{{-- Offer Date --}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('offer_date') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Data Oferty</label>
	            <input class="form-control" name="offer_date" id="input-offer_date" type="text" value="{{ old('offer_date') }}" />
	            @if ($errors->has('offer_date'))
	            <span class="material-icons form-control-feedback">clear</span>
	            <span id="offer_date-error" class="error text-danger" for="input-offer_date">{{ $errors->first('offer_date') }}</span>
	            @endif
	        </div><!--form control-->
	        {{-- Deal Date --}}
	        <div class="col-sm-6 form-group bmd-form-group {{ $errors->has('deal_date') ? ' has-danger' : '' }}">
	            <label class="bmd-label-floating">Data Umowy</label>
	            <input class="form-control" name="deal_date" id="input-deal_date" type="text" value="{{ old('deal_date') }}" />
	            @if ($errors->has('deal_date'))
	            <span class="material-icons form-control-feedback">clear</span>
	            <span id="deal_date-error" class="error text-danger" for="input-deal_date">{{ $errors->first('deal_date') }}</span>
	            @endif
	        </div><!--form control-->
        </div>
	</div>
</div>