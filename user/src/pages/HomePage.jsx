import { Carousel } from "react-responsive-carousel"
import { useEffect, useState } from "react"
import Loader from "components/Loader"
import Food from "components/Food"
import axios from "utils/axios"
import "react-responsive-carousel/lib/styles/carousel.min.css"

export default function HomePage() {
    const [sliders, setSliders] = useState([])
    const [foods, setFoods] = useState([])
    const [isFetching, setIsFetching] = useState(true)

    const fetchData = async () => {
        const [slidersRes, foodsRes] = await Promise.all([
            axios.get("https://rajesh-social-network.000webhostapp.com/food/sliders.php"),
            axios.get("https://rajesh-social-network.000webhostapp.com/food/foods.php")
        ])

        setSliders(slidersRes.data)

        setFoods(foodsRes.data)
console.log(foodsRes.data);
        setIsFetching(false)
    }

    useEffect(() => {
        fetchData()
    }, [])

    if (isFetching) {
        return <Loader />
    }

    return (
        <div className="home">
            <Carousel autoPlay={true} interval={2000} infiniteLoop stopOnHover={true}>
                {sliders.map(slider => (
                    <img src={slider.imageUrl}/>
                ))}
            </Carousel>

            <h2 className="home-title">Our Items</h2>

            <div className="home-foods">
                {foods.map(food => (
                    <Food key={food.id} food={food} />
                ))}
            </div>
        </div>
    )
}