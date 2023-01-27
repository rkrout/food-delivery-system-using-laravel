import { useRef } from "react"
import { useState } from "react"
import { toast } from "react-toastify"
import axios from "../utils/axios"

export default function CreateSliderPage() {
    const [isSubmitting, setIsSubmitting] = useState(false)

    const handleSubmit = async event => {
        event.preventDefault()

        setIsSubmitting(true)

        await axios.post("/sliders", new FormData(event.target))

        event.target.reset()

        setIsSubmitting(false)

        toast.success("Slider created successfully")
    }

    return (
        <form className="card form" onSubmit={handleSubmit}>
            <h2 className="card-header card-header-title">Create Slider</h2>

            <div className="card-body">
                <div className="form-group">
                    <label htmlFor="image" className="form-label">Image</label>
                    <input
                        type="file"
                        id="image"
                        className="form-control"
                        name="image"
                        required
                        accept=".jpeg, .jpg, .png"
                    />
                </div>

                <button
                    type="submit"
                    disabled={isSubmitting}
                    className="btn btn-primary"
                >
                    {isSubmitting ? "Please wait..." : "Save"}
                </button>
            </div>
        </form>
    )
}