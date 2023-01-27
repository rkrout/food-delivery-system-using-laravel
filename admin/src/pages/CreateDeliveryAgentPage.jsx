import { useState } from "react"
import { toast } from "react-toastify"
import axios from "../utils/axios"

export default function CreateDelveryAgentPage() {
    const [isSubmitting, setSubmitting] = useState(false)

    const handleSubmit = async event => {
        event.preventDefault()

        setSubmitting(true)
        
        try {
            await axios.post("/delivery-agents", new FormData(event.target))
            
            toast.success("Delivery boy added successfully")

            event.target.reset()

        } catch ({ response }) {

            response.status === 422 && toast.error("User not found")
        }

        setSubmitting(false)
    }

    return (
        <form className="card form" onSubmit={handleSubmit}>
            <h2 className="card-header card-header-title">Create Delivery Boy</h2>

            <div className="card-body">
                <div className="form-group">
                    <label htmlFor="email" className="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        className="form-control"
                        name="email"
                        required
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