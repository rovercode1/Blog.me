let input = document.getElementById('input');
let blockUl = document.getElementById('block-item');
let li = document.getElementsByClassName('li-item');

let inputArray = []

for (var i = 0; i < li.length; i++) {
  li[i].style.color='black'
  li[i].addEventListener('click', function(){
    if (this.style.color == 'black') {
      this.style.color='rgba(0, 0, 0, 0.42)'
      inputArray.push(this.innerHTML)
      console.log(inputArray)
    }else if(this.style.color=='rgba(0, 0, 0, 0.42)')
    {
      var index = inputArray.indexOf(this.innerHTML)
      if (index > -1) {
        inputArray.splice(index, 1)
      }
      this.style.color = 'black'
      console.log(inputArray)
    }
  })
}
