/*function AddRowOption(){
    
    alert("Add activated...");
    
    var filter_id = $("#row_count").val();
    
    // Establish the current number of filter rows and use it to index the filter row being created
	var index = $("tr.filter_row").size();
	var filter_row_id = "filter_row_" + index;
    
    // Clone the template row, change its id and class and ...
	var new_filter_row = $("#prod_data_row").clone().attr({id: "row_" + filter_row_id, class: "filter_row", style: ""});
    
    // Add dependent variables
    new_filter_row.find("select.cmdoption").attr("name", "cmdoption[" + index + "]");
	new_filter_row.find("select.cmdoption").attr("id", "cmdoption" + index);
	new_filter_row.find("select.cmdoption").attr("class", "cmdoption" + index);
    
    // Empower the delete anchor to delete the entire block
	new_filter_row.find("a").bind("click",function(){$("#row_" + filter_row_id).remove(); return false;});
    
}*/

