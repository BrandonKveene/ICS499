const input = document.querySelector('input[type="file"]')

input.addEventListener('change', function(e){
  console.log(input.files)
  const reader = new FileReader()
  
  reader.readAsText(input.files[0])

  reader.onload = function(){
    const lines = reader.result.split('\n').map(function(line){
      return line.split(',')
    })
    console.log(lines)
  }
  const csvFile = new Blob(['test'], {type: 'text/csv'})
  const xhr = new XMLHttpRequest()
  xhr.open('POST', './uploadedFiles', true)
  xhr.send(csvFile)
}, false)