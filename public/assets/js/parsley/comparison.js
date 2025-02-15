// import jQuery from 'jquery'; // Remove this line in ES3

// gt, gte, lt, lte, notequalto extra validators
var parseRequirement = function (requirement) {
  if (isNaN(+requirement))
    return parseFloat(jQuery(requirement).val());
  else
    return +requirement;
};

// Greater than validator
window.Parsley.addValidator('gt', {
  validateString: function (value, requirement) {
    return parseFloat(value) > parseRequirement(requirement);
  },
  priority: 32
});

// Greater than or equal to validator
window.Parsley.addValidator('gte', {
  validateString: function (value, requirement) {
    return parseFloat(value) >= parseRequirement(requirement);
  },
  priority: 32
});

// Less than validator
window.Parsley.addValidator('lt', {
  validateString: function (value, requirement) {
    return parseFloat(value) < parseRequirement(requirement);
  },
  priority: 32
});

// Less than or equal to validator
window.Parsley.addValidator('lte', {
  validateString: function (value, requirement) {
    return parseFloat(value) <= parseRequirement(requirement);
  },
  priority: 32
});


window.Parsley.addValidator('compare_date', {
    validateString: function(value, format) {
        var ridestart1=$("#ride_starts_at").val();
        var ridestop1=$("#ride_stops_at").val();
        // if (! value) {
        //     return true;
        // }

        var ridestart = moment(ridestart1, format, true);
        var ridestop = moment(ridestop1, format, true);
        var currValue = moment(value, format, true);


        if(currValue.isBefore(ridestop) && currValue.isAfter(ridestart)){
            return true;
        }else{
            return false;
        }
        // return date.isValid();

    },
    priority: 255,
});

window.Parsley.addValidator('compare_with_start_date', {
    validateString: function(value, format) {
        var ridestart1=$("#ride_starts_at").val();


        var ridestart = moment(ridestart1, format, true);

        var currValue = moment(value, format, true);


        if(currValue.isAfter(ridestart)){
            return true;
        }else{
            return false;
        }
        // return date.isValid();

    },
    priority: 255,
});
