const form = document.querySelector('form');
txtStatus = form.querySelector('.btn-area span');
form.onsubmit = (e)=>{
    e.preventDefault();
    txtStatus.style.color = '#0d6efd';
    txtStatus.style.display = 'block';
    let rqs = new XMLHttpRequest();
    rqs.open('POST', 'mssg.php', true );
    rqs.onload = ()=> {
        if (rqs.readyState == 4 && rqs.status ==200) {
            let response = rqs.response;
            if(response.indexOf('Email and Message field is required!' != -1) || response.indexOf("Enter a valid email address!") || response.indexOf("Sorry, failed to send your message")) {
                txtStatus.style.color = 'red';
            }else{
                form.reset();  
                setTimeout(()=>{
                    txtStatus.style.display = 'none';
                }, 3000);
            }
            txtStatus.innerText = response;
        }
    }
    let formData = new FormData(form);
    rqs.send(formData);
}