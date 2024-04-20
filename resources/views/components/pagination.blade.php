@props(['data'])

<div class="card-footer d-flex align-items-center">
   <p class="m-0 text-muted">Showing <span>{{ $data->firstItem() }}</span> to <span>{{
         $data->lastItem() }}</span> of <span>{{ $data->total() }}</span> entries</p>
   <ul class="pagination m-0 ms-auto">
      <li class="page-item {{ $data->previousPageUrl() ? '' : 'disabled' }}">
         <a class="page-link" href="{{ $data->previousPageUrl() ?? '#' }}" tabindex="-1" aria-disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
               stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
               <path stroke="none" d="M0 0h24v24H0z" fill="none" />
               <path d="M15 6l-6 6l6 6" />
            </svg>
            {{-- prev --}}
         </a>
      </li>
      @php
      $start = max(1, min($data->currentPage() - 2, $data->lastPage() - 4));
      $end = min($start + 4, $data->lastPage());
      @endphp
      @for ($i = $start; $i <= $end; $i++) <li
         class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
         <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
         </li>
         @endfor
         <li class="page-item {{ $data->nextPageUrl() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $data->nextPageUrl() ?? '#' }}">
               {{-- next --}}
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M9 6l6 6l-6 6" />
               </svg>
            </a>
         </li>
   </ul>
</div>