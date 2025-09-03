<div id="global-search-overlay" class="d-none position-fixed top-0 start-10 w-100 h-100"
     style="z-index: 1055; background: rgba(0,0,0,.50);">
  <div class="container-xxl position-relative">
    <div class="bg-body rounded-3 shadow-lg mt-3 mx-auto"
         style="max-width: 980px; border: 1px solid rgba(0,0,0,.08);">
      <div class="d-flex align-items-center p-3 border-bottom">
        <i class="ri-search-line me-2"></i>
        <input id="global-search-input" type="text" class="form-control border-0"
               placeholder="Search issues (title/description)…"
               autocomplete="off" aria-label="Global search">
        <button id="global-search-close" class="btn btn-light ms-2 rounded-pill">Close</button>
      </div>
      <div id="global-search-body" class="p-3" style="max-height: 60vh; overflow: auto;">
        <div id="global-search-loading" class="d-none">
          <div class="text-muted small">Searching…</div>
        </div>
        <div id="global-search-results"></div>
        <div id="global-search-empty" class="text-center text-muted py-5 d-none">
          <i class="ri-search-eye-line d-block mb-2" style="font-size: 2rem;"></i>
          <div>No results found.</div>
        </div>
      </div>
    </div>
  </div>
</div>
