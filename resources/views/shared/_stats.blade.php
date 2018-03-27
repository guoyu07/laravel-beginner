<div class="stats">
    <a href="">
        <strong id="follower" class="stat">
            {{ count($user->followings) }}
        </strong>
        <span>关注</span>
    </a>

    <a href="">
        <strong id="following" class="stat">
            {{ count($user->followers) }}
        </strong>
        <span>粉丝</span>
    </a>

    <a href="">
        <strong id="statuses" class="stat">
            {{ count($user->statuses) }}
        </strong>
        <span>动态</span>
    </a>
</div>