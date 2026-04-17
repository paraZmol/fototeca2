@props(['state' => 'expanded', 'size' => '14'])
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
     style="width:{{ $size }}px;height:{{ $size }}px;flex-shrink:0;transition:transform .3s;"
     :style="{{ $state }} ? 'transform:rotate(180deg)' : 'transform:rotate(0deg)'">
    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
</svg>
