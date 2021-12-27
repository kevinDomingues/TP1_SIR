filterSelection("all")
function filterSelection(filter) {
  console.log(filter);
  var x, i;
  x = document.getElementsByClassName("apontamentoscardsFeed");
  if (filter == "all") filter = "";

  for (i = 0; i < x.length; i++) {
    RemoverClass(x[i], "show");
    if (x[i].className.indexOf(filter) > -1) AdicionarClass(x[i], "show");
  }
}

function AdicionarClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

function RemoverClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

function Pesquisar() {
  var input, filter, a, txtValue;
  input = document.getElementById('txt');
  filter = input.value.toUpperCase();
  var x, i;
  x = document.getElementsByClassName("apontamentoscardsFeed");
  
  for (i = 0; i < x.length; i++) {
    a = x[i].getElementsByTagName("p")[0];
    txtValue = a.textContent || a.innerText;
    console.log(txtValue);
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      AdicionarClass(x[i], "show");
    } else {
      RemoverClass(x[i], "show");
    }
  } 
}