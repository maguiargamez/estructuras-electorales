function format(vfecha)
 {
    if ((vfecha=="") || (vfecha==null)) {
        var vresponse="s/f";
    }
    else {
        var vfecha_request=vfecha.split(" ");
        var vfecha_response=vfecha_request[0].split("-");
        var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
    }
    return vresponse;
 }