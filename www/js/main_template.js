$("#empee_tab tr:gt(1)").click(select);

function turn_page(direction){
    if (direction == "prev"){ curr_page --;}
    else { curr_page ++;}
    if (curr_page > pages){ curr_page = pages; return;}
    if (curr_page < 1){ curr_page = 1; return;}
    document.forms["frm-formPage"]["page"].value = curr_page;
    document.forms["frm-formPage"].submit();
}

function select(){
    var jq_this = $(this);
    var empno_marked = $(jq_this).children("td:first-of-type").text();
    $("#empee_tab tr.marked").removeClass("marked");
    if (empno_selected == empno_marked){
        empno_selected = "";
        $("#sals_btn").attr("disabled", true);
        $(jq_this).removeClass("marked");
        return;}
    empno_selected = empno_marked;
    $(jq_this).addClass("marked");
    $("#sals_btn").attr("disabled", false);
}

function show_sals(){
   var a = document.getElementById("sally");
   a.href = "/plat/" + empno_selected;
   a.click();
}
