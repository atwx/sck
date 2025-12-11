
import { animate, scroll, inView } from "motion";


const fadeins = document.querySelectorAll(".animation--fadein")
fadeins.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1] },
            {
                duration: 1.4,
                easing: [0.17, 0.55, 0.55, 1],
            }
        )

        return () => animate(element, { opacity: 0 }, { duration: 0 })
    })
});

const flyins = document.querySelectorAll(".animation--flyin")
flyins.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translateX(-10vw)", "translateX(0vw)"] },
            {
                duration: 1,
                easing: [0.17, 0.55, 0.55, 1],
            }
        )

        return () =>
            animate(
            element,
            { opacity: 0, transform: "translateX(-10vw)" },
            {
                duration: 0,
            }
        )
    })
});

const flyinBig = document.querySelectorAll(".animation--flyinbig")
flyinBig.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translateX(-600px)", "translateX(0px)"] },
            {
                duration: 1,
                easing: [0.17, 0.55, 0.55, 1],
            }
        )

        return () =>
        animate(
            element,
            { opacity: 0, transform: "translateX(-600px)" },
            {
                duration: 0,
            }
        )
    })
});

const bounceInLeft = document.querySelectorAll(".animation--bounceinleft")
bounceInLeft.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            {
                opacity: [0, 0, 1, 1, 1, 1],
                transform: [
                    "translate3d(-150vw, 0, 0) scaleX(3)",
                    "translate3d(-150vw, 0, 0) scaleX(3)",
                    "translate3d(25px, 0, 0) scaleX(1)",
                    "translate3d(-10px, 0, 0) scaleX(0.98)",
                    "translate3d(5px, 0, 0) scaleX(0.995)",
                    "translate3d(0, 0, 0) scaleX(1)"
                ]
            },
            {
                duration: 2.5,
                easing: [0.215, 0.61, 0.355, 1],
                offset: [0, 0.01, 0.6, 0.75, 0.9, 1]
            }
        )

        return () => animate(
            element,
            { opacity: 0, transform: "translate3d(-150vw, 0, 0) scaleX(3)" },
            { duration: 0.3 }
        )
    })
});

const backInLeft = document.querySelectorAll(".animation--backinleft")
backInLeft.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            {
                opacity: [0.7, 0.7, 1],
                transform: [
                    "translateX(-70vw) scale(0.7)",
                    "translateX(0vw) scale(0.7)",
                    "scale(1)"
                ]
            },
            {
                duration: 1.2,
                easing: [0.17, 0.55, 0.55, 1],
                offset: [0, 0.8, 1]
            }
        )

        return () => animate(
            element,
            { opacity: 0.7, transform: "translateX(-70vw) scale(0.7)" },
            { duration: 0 }
        )
    })
});

const backInRight = document.querySelectorAll(".animation--backinright")
backInRight.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            {
                opacity: [0.7, 0.7, 1],
                transform: [
                    "translateX(70vw) scale(0.7)",
                    "translateX(0px) scale(0.7)",
                    "scale(1)"
                ]
            },
            {
                duration: 1.2,
                easing: [0.17, 0.55, 0.55, 1],
                offset: [0, 0.8, 1]
            }
        )

        return () => animate(
            element,
            { opacity: 0.7, transform: "translateX(70vw) scale(0.7)" },
            { duration: 0 }
        )
    })
});

const bounceIn = document.querySelectorAll(".animation--bouncein")
bounceIn.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            {
                opacity: [0, 0, 0, 1, 1, 1],
                transform: [
                    "scale3d(0.3, 0.3, 0.3)",
                    "scale3d(1.1, 1.1, 1.1)",
                    "scale3d(0.9, 0.9, 0.9)",
                    "scale3d(1.03, 1.03, 1.03)",
                    "scale3d(0.97, 0.97, 0.97)",
                    "scale3d(1, 1, 1)"
                ]
            },
            {
                duration: 1.2,
                easing: [0.215, 0.61, 0.355, 1],
                offset: [0, 0.2, 0.4, 0.6, 0.8, 1]
            }
        )

        return () => animate(
            element,
            { opacity: 0, transform: "scale3d(0.3, 0.3, 0.3)" },
            { duration: 0 }
        )
    })
});

const bounceInRight = document.querySelectorAll(".animation--bounceinright")
bounceInRight.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            {
                opacity: [0, 0, 1, 1, 1, 1],
                transform: [
                    "translate3d(150vw, 0, 0) scaleX(3)",
                    "translate3d(150vw, 0, 0) scaleX(3)",
                    "translate3d(-25px, 0, 0) scaleX(1)",
                    "translate3d(10px, 0, 0) scaleX(0.98)",
                    "translate3d(-5px, 0, 0) scaleX(0.995)",
                    "translate3d(0, 0, 0) scaleX(1)"
                ]
            },
            {
                duration: 2.5,
                easing: [0.215, 0.61, 0.355, 1],
                offset: [0, 0.01, 0.6, 0.75, 0.9, 1]
            }
        )

        return () => animate(
            element,
            { opacity: 0, transform: "translate3d(150vw, 0, 0) scaleX(3)" },
            { duration: 0 }
        )
    })
});

// Fading Entrances
const flyInDown = document.querySelectorAll(".animation--flyindown")
flyInDown.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(0, -100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(0, -100%, 0)" }, { duration: 0 })
    })
});

const flyInDownBig = document.querySelectorAll(".animation--flyindownbig")
flyInDownBig.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(0, -90vh, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1.2, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(0, -90vh, 0)" }, { duration: 0 })
    })
});

const flyInLeft = document.querySelectorAll(".animation--flyinleft")
flyInLeft.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(-100%, 0, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(-100%, 0, 0)" }, { duration: 0 })
    })
});

const flyInLeftBig = document.querySelectorAll(".animation--flyinleftbig")
flyInLeftBig.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(-90vw, 0, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1.2, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(-90vw, 0, 0)" }, { duration: 0 })
    })
});

const flyInRight = document.querySelectorAll(".animation--flyinright")
flyInRight.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(100%, 0, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(100%, 0, 0)" }, { duration: 0 })
    })
});

const flyInRightBig = document.querySelectorAll(".animation--flyinrightbig")
flyInRightBig.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(90vw, 0, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1.2, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(90vw, 0, 0)" }, { duration: 0 })
    })
});

const flyInUp = document.querySelectorAll(".animation--flyinup")
flyInUp.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(0, 100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(0, 100%, 0)" }, { duration: 0 })
    })
});

const flyInUpBig = document.querySelectorAll(".animation--flyinupbig")
flyInUpBig.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(0, 90vh, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1.2, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(0, 90vh, 0)" }, { duration: 0 })
    })
});

const flyInTopLeft = document.querySelectorAll(".animation--flyintopleft")
flyInTopLeft.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(-100%, -100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(-100%, -100%, 0)" }, { duration: 0 })
    })
});

const flyInTopRight = document.querySelectorAll(".animation--flyintopright")
flyInTopRight.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(100%, -100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(100%, -100%, 0)" }, { duration: 0 })
    })
});

const flyInBottomLeft = document.querySelectorAll(".animation--flyinbottomleft")
flyInBottomLeft.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(-100%, 100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(-100%, 100%, 0)" }, { duration: 0 })
    })
});

const flyInBottomRight = document.querySelectorAll(".animation--flyinbottomright")
flyInBottomRight.forEach((object) => {
    inView(object, (element) => {
        animate(
            element,
            { opacity: [0, 1], transform: ["translate3d(100%, 100%, 0)", "translate3d(0, 0, 0)"] },
            { duration: 1, easing: [0.17, 0.55, 0.55, 1] }
        )
        return () => animate(element, { opacity: 0, transform: "translate3d(100%, 100%, 0)" }, { duration: 0 })
    })
});
