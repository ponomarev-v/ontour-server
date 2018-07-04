
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

function count_obj(id,svg){
$.ajax({
    type:"POST",
    url:"http://ontourapi.kvantorium33.ru/?method=map.GetObjs",
    xhrFields: {withCredentials: true},
    success: function (data) {
        data = eval("(" + data + ")");
        if (data.result == "success") {
            json_string = JSON.stringify(data);
           
            objects = JSON.parse(json_string)
            delete objects.result
            var counter = 0
            for(key in objects){
                    if(objects[key]['obl'] == "Владимир"){
                        counter+=1;
                    }
                }
            $(id,svg).mousemove(function(){
                $(".num_obj").text(counter)
            })
            $(id,svg).mouseout(function(){
                $(".num_obj").text("0")
            })
        }
    }
});
}