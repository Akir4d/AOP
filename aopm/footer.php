<style>
.bar {
  border: 1px solid #666;
  height: 20px;
  width: 100%;
}
.bar .in {
  animation: fill 10s linear 1;
  height: 100%;
  background-color: red;
}

@keyframes fill {
  0% {
    width: 0%;
  }
  100% {
    width: 100%;
  }
}
</style>
<div style="margin: auto; width: 50%; padding: 10px;">
All checks finished, this page will do an auto-refresh in 10 seconds
<div class="bar">
  <div class="in"></div>
</div>
</div>
<script>setTimeout(()=>parent.window.location.reload(true), 10000);</script>
</section>
</body>
</html>';