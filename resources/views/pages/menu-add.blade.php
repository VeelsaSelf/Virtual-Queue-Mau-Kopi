@extends('layouts.app')
@section('title','Add New Menu')
@section('page-title','Add New Menu')
@section('page-subtitle','Add a new menu item with its details, price, and available options')

@section('content')

<style>
*, *::before, *::after { box-sizing: border-box; }
[x-cloak] { display: none !important; }

.add-menu-wrap {
    background: #fff;
    border-radius: 16px;
    border: 1.5px solid #EDE8E0;
    padding: 32px 40px 40px;
}

/* Upload zone */
.upload-zone {
    display: flex;
    justify-content: center;
    margin-bottom: 32px;
}
.upload-box {
    width: 389px;
    height: 212px;
    min-width: 389px;
    max-width: 389px;
    flex-shrink: 0;
    border: 2px dashed #C8BDB5;
    border-radius: 14px;
    cursor: pointer;
    transition: border-color .18s, background .18s;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.upload-box:hover {
    border-color: #8B5E1A;
    background: #fdfaf7;
}

/* Section label */
.sec-label {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #a0a0a0;
    margin-bottom: 18px;
}

/* 2-col grid */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 32px;
    row-gap: 20px;
    margin-bottom: 28px;
}

/* Field label */
.field-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 8px;
}

/* Input */
.field-input {
    width: 100%;
    padding: 11px 14px;
    border-radius: 10px;
    border: 1.5px solid #E2D9CF;
    background: #fff;
    font-size: 13px;
    color: #1f2937;
    font-family: inherit;
    outline: none;
    transition: border-color .18s;
}
.field-input:focus { border-color: #8B5E1A; }
.field-input::placeholder { color: #b5aca4; }
textarea.field-input { resize: vertical; height: 112px; }

/* Select — NO native arrow, custom only */
.field-select {
    width: 100%;
    padding: 11px 38px 11px 14px;
    border-radius: 10px;
    border: 1.5px solid #E2D9CF;
    background: #fff;
    font-size: 13px;
    color: #1f2937;
    font-family: inherit;
    outline: none;
    cursor: pointer;
    transition: border-color .18s;

    /* kill native arrow — all browsers */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    /* custom chevron via bg-image */
    background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5l5 5 5-5' stroke='%236b7280' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 12px 8px;
}
.field-select:focus { border-color: #8B5E1A; }

/* IE/Edge kill arrow */
.field-select::-ms-expand { display: none; }

/* Checkbox */
.field-cb {
    width: 17px;
    height: 17px;
    border-radius: 4px;
    border: 1.5px solid #ccc;
    flex-shrink: 0;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    transition: background .15s, border-color .15s;
}
.field-cb:checked {
    background: #8B5E1A;
    border-color: #8B5E1A;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 10 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4l3 3 5-6' stroke='white' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 65%;
}

/* Add-on trigger */
.addon-trigger {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #E2D9CF;
    border-radius: 10px;
    background: #fff;
    font-size: 13px;
    color: #b5aca4;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: border-color .18s;
    user-select: none;
}
.addon-trigger.is-open {
    border-color: #8B5E1A;
    border-radius: 10px 10px 0 0;
}

/* Add-on list */
.addon-list {
    border: 1.5px solid #8B5E1A;
    border-top: none;
    border-radius: 0 0 10px 10px;
    overflow: hidden;
}
.addon-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 14px;
    gap: 10px;
    border-top: 1px solid #F3EDE5;
    background: #fff;
    cursor: pointer;
    transition: background .15s;
}
.addon-item:hover { background: #fdfaf7; }
.addon-item:first-child { border-top: none; }

/* Buttons */
.btn-cancel {
    padding: 10px 24px;
    border-radius: 10px;
    border: 1.5px solid #FECACA;
    background: #FFF0F0;
    color: #ef4444;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: background .18s;
}
.btn-cancel:hover { background: #fee2e2; }

.btn-save {
    padding: 10px 24px;
    border-radius: 10px;
    border: none;
    background: #8B5E1A;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
    transition: background .18s;
}
.btn-save:hover { background: #7a4f14; }
</style>

<div class="add-menu-wrap">

    {{-- ══ UPLOAD ══ --}}
    <div class="upload-zone">
        <div class="upload-box" onclick="document.getElementById('fi-img').click()"
             ondragover="event.preventDefault(); this.classList.add('hover');"
             ondragleave="this.classList.remove('hover');"
             ondrop="handleDrop(event)">
            <input type="file" id="fi-img" accept="image/*" style="display:none" onchange="previewImg(event)">

            <div id="dz-ph" style="display:flex; flex-direction:column; align-items:center; gap:0;">
                <svg style="margin-bottom:12px; display:block; color:#9ca3af;"
                     width="34" height="34" viewBox="0 0 34 34" fill="none">
                    <rect x="1" y="4" width="28" height="22" rx="4" stroke="currentColor" stroke-width="1.7"/>
                    <circle cx="9" cy="12" r="2.5" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M1 20l7-6 6 5 4-3 7 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="28" cy="7" r="5.5" fill="#fff" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M28 4.5v5M25.5 7h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
                <p style="font-size:14px; font-weight:600; color:#1f2937; margin:0 0 4px;">Choose a file or drag &amp; drop it here</p>
                <p style="font-size:12px; color:#9ca3af; margin:0 0 14px;">JPEG, PNG, and SVG formats, up to 50MB</p>
                <button type="button"
                        onclick="event.stopPropagation(); document.getElementById('fi-img').click()"
                        style="padding:7px 20px; border-radius:8px; border:1.5px solid #E2D9CF;
                               background:#fff; font-size:13px; color:#374151;
                               cursor:pointer; font-family:inherit; transition:background .18s, border-color .18s;"
                        onmouseover="this.style.borderColor='#C49060'; this.style.background='#fdf6ee';"
                        onmouseout="this.style.borderColor='#E2D9CF'; this.style.background='#fff';">
                    Browse Photo
                </button>
            </div>

            <img id="dz-preview" src="" alt="preview"
                 style="display:none; max-height:160px; width:100%; border-radius:10px; object-fit:cover;">
        </div>
    </div>

    {{-- ══ MENU INFORMATION ══ --}}
    <span class="sec-label">Menu Information</span>

    <div class="form-grid">

        <div>
            <label class="field-label">Menu Name</label>
            <input type="text" class="field-input" value="Americano" placeholder="Enter menu name">
        </div>

        <div>
            <label class="field-label">Category</label>
            <select class="field-select">
                <option>Coffee</option>
                <option>Non-Coffee</option>
                <option>Food</option>
                <option>Snack</option>
            </select>
        </div>

        <div>
            <label class="field-label">Price</label>
            <input type="text" class="field-input" value="Rp 30.000" placeholder="Rp 0">
        </div>

        <div>
            <label class="field-label">Stock</label>
            <input type="number" class="field-input" value="32" placeholder="0">
        </div>

        <div>
            <label class="field-label">Description</label>
            <textarea class="field-input" placeholder="Write a description..."></textarea>
        </div>

        <div>
            <label class="field-label">Status</label>
            <select class="field-select">
                <option>Available</option>
                <option>Not Available</option>
                <option>Out of Stock</option>
            </select>
        </div>

    </div>

    {{-- ══ MENU OPTIONS ══ --}}
    <span class="sec-label">Menu Options</span>

    <div class="form-grid" style="margin-bottom:0;">

        {{-- Add-On --}}
        <div x-data="{ open: true }">
            <label class="field-label">Add-On</label>

            <div class="addon-trigger" :class="open ? 'is-open' : ''" @click="open = !open">
                <span>Choose Add-ons</span>
                <svg :style="open ? 'transform:rotate(180deg)' : ''"
                     style="transition:transform .2s; flex-shrink:0;"
                     width="12" height="8" viewBox="0 0 12 8" fill="none">
                    <path d="M1 1.5l5 5 5-5" stroke="#6b7280" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div x-show="open" x-cloak class="addon-list">
                @foreach([
                    ['Ice Cream',  'Rp 8.000', false],
                    ['Chocolate',  'Rp 3.000', true],
                    ['Cherry',     'Rp 4.000', false],
                ] as [$name, $price, $checked])
                <label class="addon-item">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <input type="checkbox" class="field-cb" {{ $checked ? 'checked' : '' }}>
                        <span style="font-size:13px; color:#1f2937;">{{ $name }}</span>
                    </div>
                    <span style="font-size:13px; color:#6b7280; white-space:nowrap;">{{ $price }}</span>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Menu Variant + action buttons --}}
        <div style="display:flex; flex-direction:column;">
            <label class="field-label">Menu Variant</label>
            <select class="field-select">
                <option>Size, Sugar Level, Ice Level</option>
                <option>Size Only</option>
                <option>Temperature Only</option>
                <option>No Variant</option>
            </select>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:auto; padding-top:32px;">
                <a href="{{ route('menu-management') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Menu</button>
            </div>
        </div>

    </div>

</div>

<script>
function previewImg(e) {
    const file = e.target.files[0];
    if (!file) return;
    const r = new FileReader();
    r.onload = ev => {
        document.getElementById('dz-ph').style.display = 'none';
        const img = document.getElementById('dz-preview');
        img.src = ev.target.result;
        img.style.display = 'block';
    };
    r.readAsDataURL(file);
}
function handleDrop(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('hover');
    const file = e.dataTransfer.files[0];
    if (!file) return;
    const dt = new DataTransfer();
    dt.items.add(file);
    const input = document.getElementById('fi-img');
    input.files = dt.files;
    previewImg({ target: input });
}
</script>

@endsection