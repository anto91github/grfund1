(function () {

var ExampleList = function () {

  // Map of examples.
  this.examples = {};

};

ExampleList.prototype = {

  add : function (example) {
    this.examples[example.key] = example;
  },

  get : function (key) {
    return key ? (this.examples[key] || null) : this.examples;
  },

  getType : function (type) {
    return Flotr._.select(this.examples, function (example) {
      return (example.type === type);
    });
  }
}

Flotr.ExampleList = new ExampleList();

})();


(function () {

Flotr.ExampleList.add({
  key : 'basic-pie',
  name : 'Basic Pie',
  callback : basic_pie
});

function basic_pie (container) {

  var
    d1 = [[0, 4]],
    d2 = [[0, 3]],
    d3 = [[0, 1.03]],
    d4 = [[0, 3.5]],
    graph;
  
  graph = Flotr.draw(container, [
    { data : d1, label : 'Comedy' },
    { data : d2, label : 'Action' },
    { data : d3, label : 'Romance',
      pie : {
        explode : 50
      }
    },
    { data : d4, label : 'Drama' }
  ], {
    HtmlText : false,
    grid : {
      verticalLines : false,
      horizontalLines : false
    },
    xaxis : { showLabels : false },
    yaxis : { showLabels : false },
    pie : {
      show : true, 
      explode : 6
    },
    mouse : { track : true },
    legend : {
      position : 'se',
      backgroundColor : '#D2E8FF'
    }
  });
}

})();

