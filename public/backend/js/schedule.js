$( function() {
    $( "#sortable" ).sortable();
    $('[data-toggle="tooltip"]').tooltip();

    $(".CreateNoteContainer").hide();
    $(".CreateNoteBtn").click(function(){
        $(".CreateNoteContainer").show();
    });


    $(".CreateNoteClose").click(function(){
        $(".CreateNoteContainer").hide();
    });



    $("#CreateSchedule").attr("id","CreateSchedule");
    $("#UpdateSchedule").attr("id","UpdateSchedule");


    $(document).on("click", ".UpdateClose", function () {
        var value= $(this).attr('data-item');
        $("#UpdateSchedule"+value).attr("id","UpdateSchedule");
    });


    $(document).on("click", ".CreateClose", function () {
        var value= $(this).attr('data-item');
        $("#CreateSchedule"+value).attr("id","CreateSchedule");
    });


    $(document).on("click", ".OpenCreateModal", function () {
        var value= $(this).attr('data-item');
        var userId= $(this).attr('ref');
        var date= $(this).attr('ref1');
        var ref2= $(this).attr('ref2');
        // alert(userId);
        
        $(".CreateClose").attr("data-item",value);
        $("#CreateSchedule").attr("id","CreateSchedule"+value);
        $("#CreateScheduleHeader").html(`Schedule for Sub ${ref2}`);
        
        $("#date1").val(date);
        @if (request()->active == "Customer")
            $("#customer_id1").val(userId);
        @else
            $("#staff_id1").val(userId);
        @endif

        $("#CreateSchedule"+value).modal('show');
     });








     $(document).on("click", ".filtered", function () {
        var value= $(this).attr('data-item');
        var rel= $(this).attr('rel');
        var ref= $(this).attr('ref');
        $("#UpdateScheduleHeader").html(`Update Schedule ${ref}`);

        
        const myArray = rel.split("-|-");
        
        $("#customer_id").val(myArray[0]);
        $("#staff_id").val(myArray[1]);
        $("#hourly_wags").val(myArray[2]);
        $("#date").val(myArray[3]);
        $("#start_time").val(myArray[4]);
        $("#end_time").val(myArray[5]);
        $("#status").val(myArray[6]);
        $("#visibility").val(myArray[7]);
        

        $("#MyUpdateScheduleForm").attr("action",`{{ url('/schedule/update/') }}/${myArray[8]}`);
        $("#MyCopyScheduleForm").attr("action",`{{ url('/schedule/copy/') }}/${myArray[8]}`);
        $("#MyNoteScheduleForm").attr("action",`{{ url('/schedule/note/store/') }}/${myArray[8]}`);
        $("#DeleteSchedule").attr("href",`{{ url('/schedule/delete/') }}/${myArray[8]}`);
        console.log(myArray);

        $(".UpdateClose").attr("data-item",value)
        $("#UpdateSchedule").attr("id","UpdateSchedule"+value)
        $("#UpdateSchedule"+value).modal('show');
     });
