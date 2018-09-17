var Map = Object.create(null);

function get_name(){
    return this.map_name;
}

function set_name(name){
    this.map_name = name;
}

function get_objects(){
    return this.map_objects;
}

function set_objects(objects){
    this.map_objects = objects;
}

function get_map(){
    return this.map_object;
}

function set_map(map){
    this.map_object = map;
}

function set_content(content){
    this.map_content = content;
}

function get_content(){
    return this.map_content;
}

Object.defineProperty(Map,"map",{
    get:get_map,
    set:set_map,
    configurable:true,
    enumerable:true
});

Object.defineProperty(Map,"name",{
    get:get_name,
    set:set_name,
    configurable:true,
    enumerable:true
});

Object.defineProperty(Map,"objects",{
    get:get_objects,
    set:set_objects,
    configurable:true,
    enumerable:true
});

Object.defineProperty(Map,"content",{

});

Map.setStyleForObjects = function(type,style){
    Map.objects.forEach($element => {
        $(element,Map.content).css(type,style);
    });
}