
import { animate, scroll } from "motion";


const fadeins = document.querySelectorAll(".animation--fadein")
fadeins.forEach((object) => {
    scroll(animate(object, { opacity: [0, 0, 1, 1] }), {
        target: object,
        offset: ["start end", "end end", "center center", "end start"],
        type: "spring",
    })
});
