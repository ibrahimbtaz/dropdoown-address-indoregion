<!doctype html>
<html lang="en">

<head>
    <title>Dependant Dropdown Indoregion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

</head>

<body>
    <div class="container my-4">
        <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="provinsi">Provinsi</label>
            <div class="col-md-9">
                <select class="form-select single-select-field" id="provinsi" name="provinsi"
                    data-placeholder="Pilih Provinsi">
                    <option></option>
                    @foreach ($provinces as $item)
                        <option value="{{ $item->id}}">{{ $item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
            <div class="col-md-9">
                <select class="form-select single-select-field" name="kota" id="kota" data-placeholder="Pilih Kota" required>
                    <option></option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
            <div class="col-md-9">
                <select class="form-select single-select-field" name="kecamatan" id="kecamatan" data-placeholder="Pilih kecamatan" required>
                    <option></option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-md-3 col-form-label" for="desa">Desa</label>
            <div class="col-md-9">
                <select class="form-select single-select-field" name="desa" id="desa" data-placeholder="Pilih Desa" required>
                    <option></option>
                </select>
            </div>
        </div>
    </div>

    {{-- <script></script> --}}

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            function onChangeSelect(url, id, name) {
                // send ajax request to get the regency of the selected province and append to the select tag
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let target = $('#' + name);
                        target.attr('disabled', false);
                        target.empty()
                        target.attr('placeholder', target.data('placeholder'))
                        target.append(`<option> ${target.data('placeholder')} </option>`)
                        $.each(data, function(key, value) {
                            target.append(`<option value="${key}">${value}</option>`)
                        });
                    }
                });
            }

            $('#kota').prop('disabled', true);
            $('#kecamatan').prop('disabled', true);
            $('#desa').prop('disabled', true);


            $('#provinsi').on('change', function() {
                var id = $(this).val();
                var url = `{{ route('get.regency') }}`;
                $('#kota').empty().prop('disabled', false);
                $('#kecamatan').empty().prop('disabled', true);
                $('#desa').empty().prop('disabled', true);
                onChangeSelect(url, id, 'kota');
            });

            $('#kota').on('change', function() {
                var id = $(this).val();
                var url = `{{ route('get.districts') }}`;
                $('#kecamatan').empty().prop('disabled', false);
                onChangeSelect(url, id, 'kecamatan');
            });

            $('#kecamatan').on('change', function() {
                var id = $(this).val();
                var url = `{{ route('get.villages') }}`;
                $('#desa').empty().prop('disabled', false);
                onChangeSelect(url, id, 'desa');
            });

            $('.single-select-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>
</body>

</html>
