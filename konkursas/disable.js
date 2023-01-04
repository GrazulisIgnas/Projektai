// jog veiktų naudojamam faile reikia pridėt:
//     * <script> const arr = [];const op = []; </script> 
//          pries form'ą
//     * <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 
//          head'e
// taip pat select id turi būt nuo 1 ir ++
function disable(arr, options, value, id, n){
    yes = 0;
    for(i = 0; i < options.length; i++){
        if (options[i] == id){
            yes = 1;
            options[i] = id;
            arr[i] = value;
        }
    }
    if (yes == 0){
        options[options.length] = id;
        arr[arr.length] = value;
    }
    for(i=1; i<=n; i++){
        $("#"+i+" option[value!=-1]").show();
        for(j = 0; j < arr.length; j++){
            $("#"+i+" option[value='"+arr[j]+"']").hide();
        }
    }
}