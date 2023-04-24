import ReactDOM from "react-dom/client";
import React from "react";
import Routes from "./routes";


if (document.getElementById('app')) {
    const Index = ReactDOM.createRoot(document.getElementById("app"));

    Index.render(
        <React.StrictMode>
            <Routes/>
        </React.StrictMode>
    )
}
