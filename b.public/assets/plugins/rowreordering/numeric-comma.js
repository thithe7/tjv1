/**
 * It is not uncommon for non-English speaking countries to use a comma for a
 * decimal place. This sorting plug-in shows how that can be taken account of in
 * sorting by adding the type `numeric-comma` to DataTables. A type detection 
 * plug-in for this sorting method is provided below.
 * 
 * Please note that the 'Formatted numbers' type detection and sorting plug-ins
 * offer greater flexibility that this plug-in and should be used in preference
 * to this method.
 *
 *  @name Commas for decimal place
 *  @summary Sort numbers correctly which use a comma as the decimal place.
 *  @deprecated
 *  @author [Allan Jardine](http://sprymedia.co.uk)
 *
 *  @example
 *    $('#example').dataTable( {
 *       columnDefs: [
 *         { type: 'numeric-comma', targets: 0 }
 *       ]
 *    } );
 */

jQuery.fn.dataTableExt.oSort['numeric-comma-asc'] = function (a, b) {
    //remove the dots (.) from the string and then replaces the comma with a dot
  var x = (a == "-") ? 0 : a.replace(/\./g, "").replace(/,/, ".");
  var y = (b == "-") ? 0 : b.replace(/\./g, "").replace(/,/, ".");
  x = parseFloat(x);
  y = parseFloat(y);
  return ((x < y) ? -1 : ((x > y) ? 1 : 0));
};

jQuery.fn.dataTableExt.oSort['numeric-comma-desc'] = function (a, b) {
  var x = (a == "-") ? 0 : a.replace(/\./g, "").replace(/,/, ".");
  var y = (b == "-") ? 0 : b.replace(/\./g, "").replace(/,/, ".");
  x = parseFloat(x);
  y = parseFloat(y);
  return ((x < y) ? 1 : ((x > y) ? -1 : 0));
};

//numeric comma autodetect
jQuery.fn.dataTableExt.aTypes.unshift(
            function (sData) {
   //include the dot in the sValidChars string (don't place it in the last position)
              var sValidChars = "0123456789-.,";
              var Char;
              var bDecimal = false;

              /* Check the numeric part */
              for (i = 0 ; i < sData.length ; i++) {
                Char = sData.charAt(i);
                if (sValidChars.indexOf(Char) == -1) {
                  return null;
                }

                /* Only allowed one decimal place... */
                if (Char == ",") {
                  if (bDecimal) {
                    return null;
                  }
                  bDecimal = true;
                }
              }

              return 'numeric-comma';
            }
        );