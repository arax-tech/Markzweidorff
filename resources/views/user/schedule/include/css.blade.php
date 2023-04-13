@section('css')
<style type="text/css">
    .img-fluid{max-width: 260% !important;}
    a{text-decoration: none !important;}
    /*.myBell{font-size: 500px !important}*/
    .btn-transparent-dark{border-radius: 50% !important}
    .btn-transparent-dark::before{display: none !important}
    .btn-sm, .btn-group-sm > .btn {
    padding: 0.5rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 0.25rem;
    }
    .input{padding: 0.7rem 1.125rem !important;}
    .nav-pills .nav-link{color: #31353d !important; border-radius: 0px !important;
        padding: 5px !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
        color: #f53b57 !important;
        border-bottom: 3px solid #f53b57 !important;
        background: #f2f6fc !important;
        outline: none !important;
        border-radius: 0px !important;
        padding: 5px !important;
    }
    .nav-item{margin-left: 13px !important; margin-top: -8px !important}
    .form-check-label{cursor: pointer;}
    .font-weight-bolder{font-weight: bolder !important;}
    .modal-dialog .modal-content .modal-header{border-bottom: none !important;}
    .tata .tata-text{color: #fff !important}
    .grid-wrapper > .grid-header{top: 125px !important}
    .grid-wrapper > .grid .grid-row .cell:first-child .title{
        color: #212832 !important;
        font-size: 0.9rem !important;
    }
    .grid-wrapper > .grid-header .cell .title{
        color: #212832 !important;
        font-size: 0.9rem !important;
    }
    .schedule-item .heading .title{
        color: #212832 !important;
        font-size: 0.9rem !important;
        font-weight: 600 !important;
    }
    .grid-wrapper .cell .totals, .grid-wrapper .cell .timesheets-delta{
        font-size: 0.9rem !important;

    }
    .schedule-item.shift .heading, .schedule-item.shift .details, .schedule-item.shift .break-details{
        font-size: 0.9rem !important;

    }
    .grid-wrapper > .grid .grid-row{
        min-height: 80px !important;
    }

    .update-modal-content{
        min-height: 700px !important;
    }

    .input-group-text{
        border-radius: 5px 0px 0px 5px !important;
    }


    .grid-wrapper > .grid .grid-row.grid-row:hover{
        /* border: 1px solid #f53b57 !important; */
        position: relative;
        z-index: 999;
        background: #f7f8fa !important;
        transition: 0.5s ease !important;
    }
    .grid-wrapper > .grid .grid-row.grid-row:hover .cell {
        background: transparent !important;
    }
    .schedule-item:first-child{
        margin: 0.2rem 0.2em 0.2em !important;
    }




    .cells{
        background: #fff !important;
    }

    .grid-header{
        background: #f7f8fa !important;
    }
    .cell-header{
        background: #f7f8fa !important;
    }

    .page-body{
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%) !important;
        margin-top: -15px !important
    }






    .week-topbar-dropdown-menu {
        padding: 0.5rem !important;
        min-width: 5.1rem !important;
    }

    .btn-right-arrow {
        position: initial !important;
    }

    .grid-wrapper > .grid-header:first-child .cell {
        box-shadow: none !important;
    }


    .page-filters {
        border-top: 0px !important;
    }




    .select2-container--default .select2-selection--single{
      background-color: #fff !important;
      border: 0.0625rem solid #f8f8f8 !important;
      padding: 0.1rem 1.25rem !important;
      color: #6e6e6e !important;
      height: 2.88rem !important;
      border: 1px solid #c5ccd6 !important;

      border-radius: 0rem 0.35rem 0.35rem 0rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
      line-height: 40px !important;
      color: #69707a;
      font-size: 0.9rem !important;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
      color: #69707a !important;
      font-size: 0.9rem !important;
    }
    .select2-results__option{
      color: #69707a !important;
      font-size: 0.9rem !important;
    }
    .select2-results__option--selectable{
      color: #000 !important;
      font-size: 0.9rem !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
        background: #f53b57 !important;
        color: #fff !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
      padding-left: 0px !important
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
      top: 10px !important;
      right: 13px !important;
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field{
        outline: none !important;
    }




    .select2-container--default.select2-container--focus .select2-selection--multiple{
      background-color: #fff !important;
      border: 0.0625rem solid #f8f8f8 !important;
      padding: 0.1rem 1.25rem !important;
      color: #6e6e6e !important;
      height: 2.88rem !important;
      border: 1px solid #c5ccd6 !important;

      border-radius: 0rem 0.35rem 0.35rem 0rem !important;
    }
    .select2-container .select2-selection--multiple{
      background-color: #fff !important;
      border: 0.0625rem solid #f8f8f8 !important;
      padding: 0.1rem 1.25rem !important;
      color: #6e6e6e !important;
      height: 2.88rem !important;
      border: 1px solid #c5ccd6 !important;

      border-radius: 0rem 0.35rem 0.35rem 0rem !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        margin-top: 10px !important;
        background-color: #f2f2f2 !important;
        border: 1px solid lightgray !important;
        font-size: 12px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice:first-child{
        margin-left: -10px !important;
    }






    .input-group{
        flex-wrap: nowrap !important;
    }

    .btn-default:active, .btn-input:active, .btn-default:hover, .btn-input:hover{
        color: #000 !important;
    }


    input[type="time"]::-webkit-calendar-picker-indicator {
        background: none !important;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        background: none !important;
    }
    input[type="week"]::-webkit-calendar-picker-indicator {
        background: none !important;
    }

    .title{
        font-size: 0.74rem !important;
    }
    .details{
        font-size: 0.74rem !important;
    }
    .ui-droppable-hover {
        /*background: #00ab695e;*/
        border: 1px dashed #018551;
        /* outline: 1px dashed; */
        margin: 5px;



    }
    .all-days-switch {
        height: 1.7em !important;
        width: 4em !important;
        margin-top: 0.25em;
        vertical-align: top;
        background-color: #fff;
    }

    .time-on{
        color: #00bc1d !important;
        background-color: #ccf2d2 !important;
        cursor: pointer !important;
    }


    .context-menu-item{
        padding: 0.5em 2em !important;
        background-color: #f2f6fc !important;
        font-size: 0.74rem !important;
    }
    .context-menu-list{
        padding: 0rem !important;
    }
    .context-menu-item.context-menu-hover{
        background: #f2f2f2 !important;
        color: #000 !important;
    }


    .context-menu-icon::before{
        color: #f53b57 !important;
    }
    .context-menu-separator{
        margin: 0px !important;
        padding: 0px !important;
        border-bottom: 1px solid lightgray !important;
    }


    /* menu header */
    .context-menu-one-title:before {
        content: "Vagt";
        display: block;
        top: 0;
        right: 0;
        left: 0;
        background: #3e445e;
        padding: 5px;
        color: #fff;
        font-size: 0.8rem;
    }
    .context-menu-two-title:before {
        content: "Ny vagt";
        display: block;
        top: 0;
        right: 0;
        left: 0;
        background: #3e445e;
        padding: 5px;
        color: #fff;
        font-size: 0.8rem;
    }

    .borderRL{
        border-left: 1px dashed #f53b57 !important; border-right: 1px dashed #f53b57 !important;  border-bottom: 1px solid #e5e9f0 !important;  border-bottom: 1px solid #e5e9f0 !important;
    }
    .borderAH{
        border-left: 1px dashed #f53b57 !important; border-right: 1px dashed #f53b57 !important;  border-bottom: 1px solid #e5e9f0 !important;  border-top: 1px dashed red !important;
    }
    .activeHC{
        color : #f53b57 !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #f2f2f2;
        border: 1px solid lightgray;
        font-size: 12px;
    }
    #select2-staff_id1-results .select2-results__option>font{
        display: flex !important;
        justify-content: space-between !important;
    }
    #select2-staff_id1-results .select2-results__option>font font:nth-child(1){
        background-color: #00bc1d !important;
    }
    #select2-staff_id1-results .select2-results__option>font font:nth-child(2){
        background-color: #000 !important;
    }
    .schedule-item .details > span:not(:last-child):after{content: "" !important}


    .schedule-icon:hover{color: #f53b57 !important}
    .alert-primary:hover{color: #003a91 !important}
    /*.schedule-item-list:after{min-width: 120px !important}*/

</style>
<link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/schedule.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

@endsection
