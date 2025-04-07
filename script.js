const stars = document.querySelectorAll(".stars i");

stars.forEach((star, index1) =>{

    star.addEventListener("click", () =>{
        

        stars.forEach((star,index2) =>{
            index1 >= index2 ? star.classList.add("active") : star.classList.remove("active")


            // function myFunction() {
            //     document.getElementById("newdiv").style.border="thick solid #0000ff";
            //   }

            $.ajax({
                url:'eq-details.php',
                method:'POST',
                data:{rating_value:rating_value},
            })
        })
    })
})