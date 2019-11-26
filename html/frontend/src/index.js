import React from 'react'
import { render } from 'react-dom'
import {BrowserRouter} from "react-router-dom";
import App from './App'
import './index.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.css';


render(
    <BrowserRouter>
        <App />
    </BrowserRouter>,
document.getElementById('root')
);

