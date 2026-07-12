@extends('layouts.backend')

@section('title', 'New Prescription')
@section('page-title', 'New Prescription')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.prescriptions.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="patient_id">Patient</label>
                            <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id">
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (string) old('patient_id') === (string) $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->patient_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="doctor_id">Doctor</label>
                            <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id">
                                <option value="">Select doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ (string) old('doctor_id') === (string) $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="prescription_date">Date</label>
                            <input type="date" class="form-control @error('prescription_date') is-invalid @enderror" id="prescription_date" name="prescription_date" value="{{ old('prescription_date', now()->format('Y-m-d')) }}">
                            @error('prescription_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="follow_up_date">Follow-up Date <span class="text-muted">(optional)</span></label>
                            <input type="date" class="form-control @error('follow_up_date') is-invalid @enderror" id="follow_up_date" name="follow_up_date" value="{{ old('follow_up_date') }}">
                            @error('follow_up_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="diagnosis">Diagnosis</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" rows="2">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Medicines (Rx)</h5>

                    <div class="table-responsive">
                        <table class="table" id="items-table">
                            <thead>
                                <tr>
                                    <th style="min-width: 180px;">Medicine Name</th>
                                    <th style="width: 120px;">Dosage</th>
                                    <th style="width: 130px;">Frequency</th>
                                    <th style="width: 110px;">Duration</th>
                                    <th style="min-width: 160px;">Instructions</th>
                                    <th style="width: 40px;"></th>
                                </tr>
                            </thead>
                            <tbody id="items-body">
                                @php $oldMedicines = old('medicines', [['name' => '', 'dosage' => '', 'frequency' => '', 'duration' => '', 'instructions' => '']]); @endphp
                                @foreach ($oldMedicines as $i => $medicine)
                                    <tr class="item-row">
                                        <td><input type="text" name="medicines[{{ $i }}][name]" class="form-control" value="{{ $medicine['name'] ?? '' }}" placeholder="e.g. Napa 500mg"></td>
                                        <td><input type="text" name="medicines[{{ $i }}][dosage]" class="form-control" value="{{ $medicine['dosage'] ?? '' }}" placeholder="1+1+1"></td>
                                        <td><input type="text" name="medicines[{{ $i }}][frequency]" class="form-control" value="{{ $medicine['frequency'] ?? '' }}" placeholder="After meal"></td>
                                        <td><input type="text" name="medicines[{{ $i }}][duration]" class="form-control" value="{{ $medicine['duration'] ?? '' }}" placeholder="7 days"></td>
                                        <td><input type="text" name="medicines[{{ $i }}][instructions]" class="form-control" value="{{ $medicine['instructions'] ?? '' }}" placeholder="Optional note"></td>
                                        <td><button type="button" class="btn btn-sm btn-soft-danger remove-row"><i class="las la-times"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('medicines') <span class="text-danger d-block mb-2">{{ $message }}</span> @enderror

                    <button type="button" class="btn btn-sm btn-soft-primary mb-3" id="add-row"><i class="las la-plus"></i> Add Medicine</button>

                    <div class="mb-3">
                        <label class="form-label" for="advice">Advice</label>
                        <textarea class="form-control" id="advice" name="advice" rows="2">{{ old('advice') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Prescription</button>
                        <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection

@push('scripts')
<script>
    (function () {
        const itemsBody = document.getElementById('items-body');
        const addRowBtn = document.getElementById('add-row');
        let rowIndex = document.querySelectorAll('.item-row').length;

        function rowTemplate(index) {
            const tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = `
                <td><input type="text" name="medicines[${index}][name]" class="form-control" placeholder="e.g. Napa 500mg"></td>
                <td><input type="text" name="medicines[${index}][dosage]" class="form-control" placeholder="1+1+1"></td>
                <td><input type="text" name="medicines[${index}][frequency]" class="form-control" placeholder="After meal"></td>
                <td><input type="text" name="medicines[${index}][duration]" class="form-control" placeholder="7 days"></td>
                <td><input type="text" name="medicines[${index}][instructions]" class="form-control" placeholder="Optional note"></td>
                <td><button type="button" class="btn btn-sm btn-soft-danger remove-row"><i class="las la-times"></i></button></td>
            `;
            return tr;
        }

        addRowBtn.addEventListener('click', function () {
            itemsBody.appendChild(rowTemplate(rowIndex));
            rowIndex++;
        });

        itemsBody.addEventListener('click', function (e) {
            const btn = e.target.closest('.remove-row');
            if (!btn) return;
            if (document.querySelectorAll('.item-row').length > 1) {
                btn.closest('.item-row').remove();
            }
        });
    })();
</script>
@endpush
