import { createContext, useEffect, useState } from "react"
import axios from "../utils/axios"
import { BASE_URL } from "../utils/constants"
import Loader from "./Loader"

export const AuthContext = createContext()

export default function Auth({ children }) {
    const [currentUser, setCurrentUser] = useState()
    const [isLoading, setIsLoading] = useState(true)

    const fetchCurrentUser = async () => {
        const { data } = await axios.get(BASE_URL + "/auth")
        setCurrentUser(data.user)
        setIsLoading(false)
    }

    useEffect(() => {
        fetchCurrentUser()
    }, [])

    if (isLoading) {
        return <Loader/>
    }

    if(!currentUser || !currentUser.isAdmin) {
        return <p className="page-error">Please login to continue</p>
    }

    return (
        <AuthContext.Provider value={{ currentUser, setCurrentUser }}>
            {children}
        </AuthContext.Provider>
    )
}

