import { useState, useEffect } from "react"

export default function Filter () {

    const [initialProduct, setInitialProduct ] = useState([])
    const [products, setProducts ] = useState([])
    const [loading, setLoading] = useState(true)

    useEffect (() => {
        fetchData()

    }, [])
async function fetchData() {
    try {
        const response = await fetch("/api", {
          headers: {
            Accept: "application/json",
          },
        }).then((r) => r.json());
        setProducts(response);
        setInitialProduct(response);
        setLoading(false);
      } catch (error) {
        console.log(error);
      }
    
}
}