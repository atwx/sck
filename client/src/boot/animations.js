
import { animate, scroll, inView } from "motion";


const fadeins = document.querySelectorAll(".animation--fadein")
fadeins.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: 1 },
            {
                duration: 1,
                easing: [0.17, 0.55, 0.55, 1],
            }
        )

        return () => animate(element, { opacity: 0 })
    })
});

const flyins = document.querySelectorAll(".animation--flyin")
flyins.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: 1, transform: "translateX(0px)" },
            {
                duration: 1,
                easing: [0.17, 0.55, 0.55, 1],
            }
        )

        return () =>
            animate(element, { opacity: 0, transform: "translateX(-40px)" })
    })
});
