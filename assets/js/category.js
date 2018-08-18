let input = document.getElementById('input');
let blockUl = document.getElementById('block-item');
let li = document.getElementsByClassName('li-item');
let btn = document.getElementById('btn');
let inputArray = []

for (var i = 0; i < li.length; i++) {
  li[i].style.color='rgba(0, 0, 0, 0.42)';
  li[i].addEventListener('click', function(){
    if (this.style.color == 'rgba(0, 0, 0, 0.42)') {
      this.style.color='black';
      inputArray.push(this.innerHTML);
      console.log(inputArray);
      input.value = inputArray
    }else if(this.style.color=='black')
    {
      var index = inputArray.indexOf(this.innerHTML);
      if (index > -1) {
        inputArray.splice(index, 1);
      }
      this.style.color = 'rgba(0, 0, 0, 0.42)';
      console.log(inputArray);
      input.value = inputArray;
    }
  })
  btn.addEventListener('click', function() {
    input.value = inputArray;
  })
}
