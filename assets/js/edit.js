/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
$(document).ready(function(){

    // This example only specifies a URL to handle the POST request to
    // the server, and tells the script to show the save / cancel buttons
    $(".editme1").editInPlace({
        url: "includes/update_servers.php",
        field_type: "textarea",
        textarea_rows: "1",
        textarea_cols: "25",
        show_buttons: true
    });

    // This example shows how to call the function and display a textarea
    // instead of a regular text box. A few other options are set as well,
    // including an image saving icon, rows and columns for the textarea,
    // and a different rollover color.
    $(".editme2").editInPlace({
        url: "includes/update_ports.php",
        bg_over: "#cff",
        field_type: "textarea",
        textarea_rows: "1",
        textarea_cols: "15",
         show_buttons: true
    });

    // A select input field so we can limit our options
    $(".editme3").editInPlace({
        url: "./server.php",
        field_type: "select",
        select_options: "Change me to this, No way:no"
    });

    // Using a callback function to update 2 divs
    $(".editme4").editInPlace({
        url: "./server.php",
        callback: function(original_element, html, original){
            $("#updateDiv1").html("The original html was: " + original);
            $("#updateDiv2").html("The updated text is: " + html);
            return(html);
        }
    });
});
