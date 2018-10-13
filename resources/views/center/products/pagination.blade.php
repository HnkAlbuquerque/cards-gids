
<?php
// config
        $a =1;
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

<!-- APENAS NOTAÇÃO PARA OUTRO TIPO DE PAGINAÇÃO... 1 A 1, APENAS PARA POUCAS PAGINAS -->
@if($a == 0)
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $paginator->url(1) }}" class="item-pagination flex-c-m trans-0-4"> << </a>

            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li>
                    <a href="{{ $paginator->url($i) }}" class="item-pagination flex-c-m trans-0-4 {{ ($paginator->currentPage() == $i) ? ' active-pagination' : '' }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="item-pagination flex-c-m trans-0-4"> >> </a>
            </li>
        </ul>
    @endif

@endif

<!-- MODELO UTILIZADO E ATIVO PARA MUITAS PAGINAS -->
@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}" class="item-pagination flex-c-m trans-0-4"> <<< </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li>
                    <a href="{{ $paginator->url($i) }}" class="item-pagination flex-c-m trans-0-4 {{ ($paginator->currentPage() == $i) ? ' active-pagination' : '' }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="item-pagination flex-c-m trans-0-4">>>></a>
        </li>
    </ul>
@endif
