import React from "react";
import "../style/adminlogin.css";
import { useState } from "react";
import axios from "axios"

const Login = () => {

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [isLoading, setIsLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      const res = await axios.post("http://localhost/repose/api/login", {
        email,
        password,
      });
      localStorage.setItem("session", email);
      window.location.href = "/";
    } catch (err) {
      setError(err.response.data.error);
    } finally {
      setIsLoading(false);
    }
  };




    const [popupStyle, showPopup] = useState("hide");

    const popup = () => {
        showPopup("login-popup")
        setTimeout(() => showPopup("hide"), 3000)
    }

  return (
    <div className="ad-log">
      <div className="logo1">
        <img src={require("../img/logo.png")} />
      </div>

      <div className="adminlog-form">
        <h1>Admin Login</h1>
        <form className="adminlog-form" onSubmit={handleSubmit}>
          {error && <p className="error">{error}</p>}
          <input
            type="email"
            placeholder="Enter Email"
            name="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
          <input
            type="password"
            placeholder="Enter Password"
            name="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />

          <input
            type="submit"
            value="Login"
            name="login"
            className="login-btn"
            // onClick={popup}
          />
          {isLoading ? "Loading..." : ""}
        </form>
      </div>

      <div className={popupStyle}>
        <h3>Login Failed</h3>
        <p>Username or Password are Incorrect</p>
      </div>
    </div>
  );
};

export default Login;
