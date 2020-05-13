<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            <input class="form-check-input @error('accept_terms') is-invalid @enderror"
                   type="checkbox" name="accept_terms" id="accept_terms" {{ old('accept_terms') ? 'checked' : '' }}>

            <label class="form-check-label" for="accept_terms">
                Aceptar <a href="#">Términos y condiciones</a> del sitio
            </label>
            @error('accept_terms')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
