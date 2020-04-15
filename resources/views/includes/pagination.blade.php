<nav class="d-flex justify-content-center " id="pages-show" >
    <ul class="pagination pg">
        <li class="page-item" v-bind:class="pagination.current_page == 1 ? 'disabled' : '' ">
            <a class="page-link text-dark" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                <span>Atras</span>
            </a>
        </li>

        <li class="page-item" v-for="page in pagesNumber" v-bind:class=" [page == isActive ? 'active' :  '']">
            <a class="page-link text-dark" href="#" @click.prevent="changePage(page)">
                @{{ page }}
            </a>
        </li>

        <li class="page-item" v-bind:class="pagination.current_page == pagination.last_page ? 'disabled' : '' ">
            <a class="page-link text-dark" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                <span>Siguiente</span>
            </a>
        </li>
    </ul>
</nav>